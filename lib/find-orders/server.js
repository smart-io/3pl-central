'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

exports.default = function (beginDate, endDate) {
  return new Promise(function (resolve, reject) {
    if (!endDate) endDate = (0, _moment2.default)();
    if (typeof beginDate === 'string') beginDate = (0, _moment2.default)(beginDate);
    if (typeof endDate === 'string') endDate = (0, _moment2.default)(endDate);
    new _request2.default('POST', 'http://www.JOI.com/schemas/ViaSub.WMS/FindOrders', _path2.default.join(__dirname, 'request', 'find-orders.xml')).fetch({
      BeginDate: beginDate.format('YYYY-MM-DD'),
      EndDate: endDate.format('YYYY-MM-DD')
    }).then(function (response) {
      resolve(response['FindOrders']['orders']['order']);
    }).catch(reject);
  });
};

var _path = require('path');

var _path2 = _interopRequireDefault(_path);

var _moment = require('moment');

var _moment2 = _interopRequireDefault(_moment);

var _request = require('../request');

var _request2 = _interopRequireDefault(_request);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }