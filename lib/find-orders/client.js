'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

exports.default = function (beginDate) {
  return new Promise(function (resolve, reject) {
    var seneca = (0, _client2.default)();

    seneca.act({ role: '3pl-central', cmd: 'findOrders', beginDate: beginDate }, function (err, res) {
      if (err) reject(err);else resolve(res);
    });
  });
};

var _client = require('../client');

var _client2 = _interopRequireDefault(_client);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

;