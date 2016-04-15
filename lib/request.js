'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _fs = require('fs');

var _fs2 = _interopRequireDefault(_fs);

var _isomorphicFetch = require('isomorphic-fetch');

var _isomorphicFetch2 = _interopRequireDefault(_isomorphicFetch);

var _xml2js = require('xml2js');

var _xml2js2 = _interopRequireDefault(_xml2js);

var _response = require('./response');

var _response2 = _interopRequireDefault(_response);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Request = function () {
  function Request(method, url, contentFile) {
    var _this = this;

    _classCallCheck(this, Request);

    this.parseResponse = function (response) {
      return new Promise(function (resolve, reject) {
        _xml2js2.default.parseString(response, function (err, result) {
          if (err) return reject(err);
          var response = {};
          var body = result['soap:Envelope']['soap:Body'][0];
          var asyncCalls = 0;

          var _loop = function _loop(prop) {
            if (body.hasOwnProperty(prop)) {
              asyncCalls++;
              _this.parseXml(body[prop][0]['_']).then(function (xml) {
                asyncCalls--;
                response[prop] = xml;
                if (asyncCalls === 0) resolve(response);
              });
            }
          };

          for (var prop in body) {
            _loop(prop);
          }
        });
      });
    };

    this.method = method;
    this.url = url;
    this.contentFile = contentFile;
  }

  _createClass(Request, [{
    key: 'fetch',
    value: function fetch(data) {
      var _this2 = this;

      return new Promise(function (resolve, reject) {
        _this2.readContentFile().then(function (content) {
          return _this2.replaceContentData(content, data);
        }).then(function (content) {
          (0, _isomorphicFetch2.default)('https://secure-wms.com/webserviceexternal/contracts.asmx', {
            method: 'post',
            headers: {
              'SOAPAction': _this2.url,
              'Content-Type': 'text/xml; charset=utf-8'
            },
            body: content
          }).then(function (response) {
            if (response.status >= 400) return reject();
            return response.text();
          }).then(_this2.parseResponse).then(function (response) {
            return resolve(new _response2.default(response));
          });
        });
      });
    }
  }, {
    key: 'readContentFile',
    value: function readContentFile() {
      var _this3 = this;

      return new Promise(function (resolve, reject) {
        _fs2.default.readFile(_this3.contentFile, 'utf8', function (err, data) {
          if (err) return reject(err);
          resolve(data);
        });
      });
    }
  }, {
    key: 'replaceContentData',
    value: function replaceContentData(content, data) {
      data = _extends({}, data, {
        ThreePLID: process.env.THREEPL_ID,
        Login: process.env.THREEPL_LOGIN,
        Password: process.env.THREEPL_PASSWORD,
        CustomerID: process.env.THREEPL_CUSTOMERID,
        FacilityID: process.env.THREEPL_FACILITYID
      });

      for (var prop in data) {
        if (data.hasOwnProperty(prop)) {
          content = content.replace('{' + prop + '}', data[prop]);
        }
      }
      return content;
    }
  }, {
    key: 'parseXml',
    value: function parseXml(content) {
      return new Promise(function (resolve, reject) {
        if (content.indexOf('<') === -1) resolve(content);

        _xml2js2.default.parseString(content, function (err, result) {
          if (err) return reject();
          resolve(result);
        });
      });
    }
  }]);

  return Request;
}();

exports.default = Request;