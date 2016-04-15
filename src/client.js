import Seneca from 'seneca';

let client;

export default function () {
  if (client) return client;
  const seneca = Seneca({ log: 'quiet' });

  let config = process.env['3PL_CENTRAL_PORT'].match(/\/\/([^:]*):?(\d*)/);

  seneca.client({
    host: config[1],
    port: config[2]
  });

  return seneca;
};
