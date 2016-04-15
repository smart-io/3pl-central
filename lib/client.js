'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

exports.default = function () {
  if (client) return client;
  process.stdin.resume();

  var seneca = (0, _seneca2.default)({ log: 'quiet' });

  var config = process.env['3PL_CENTRAL_PORT'].match(/\/\/([^:]*):?(\d*)/);

  seneca.client({
    host: config[1],
    port: config[2]
  });

  function exitHandler() {
    seneca.close(function (err) {
      if (err) console.error('err: ' + err);
    });
  }

  process.on('exit', exitHandler);
  process.on('SIGINT', exitHandler);
  process.on('uncaughtException', exitHandler);

  return seneca;
};

var _seneca = require('seneca');

var _seneca2 = _interopRequireDefault(_seneca);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var client = void 0;

;