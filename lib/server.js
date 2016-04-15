'use strict';

var _dotenv = require('dotenv');

var _dotenv2 = _interopRequireDefault(_dotenv);

var _server = require('./find-orders/server');

var _server2 = _interopRequireDefault(_server);

var _seneca = require('seneca');

var _seneca2 = _interopRequireDefault(_seneca);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

_dotenv2.default.config();

var seneca = (0, _seneca2.default)({ timeout: 99999 });

seneca.add({ role: '3pl-central', cmd: 'findOrders' }, function (msg, respond) {
  (0, _server2.default)(msg.beginDate).then(function (orders) {
    return respond(null, orders);
  });
});

seneca.listen();