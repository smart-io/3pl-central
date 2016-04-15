import Seneca from 'seneca';

let client;

export default function () {
  if (client) return client;
  process.stdin.resume();

  const seneca = Seneca({ log: 'quiet' });

  let config = process.env['3PL_CENTRAL_PORT'].match(/\/\/([^:]*):?(\d*)/);

  seneca.client({
    host: config[1],
    port: config[2]
  });

  function exitHandler() {
    seneca.close(function (err) {
      if (err) console.error('err: ' + err)
    });
  }

  process.on('exit', exitHandler);
  process.on('SIGINT', exitHandler);
  process.on('uncaughtException', exitHandler);

  return seneca;
};
