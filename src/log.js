import Log from 'log';
import fs from 'fs';
import stream from 'stream';

class LogStream extends stream.Writable {
  static path = '/var/log/3pl-central.log';

  constructor() {
    super();
    try {
      fs.lstatSync(LogStream.path);
    } catch (e) {
      fs.openSync(LogStream.path, 'w');
    }
    this._writeStream = fs.createWriteStream(LogStream.path)
  }

  _write(chunk, encoding, done) {
    process.stdout.write(chunk.toString());
    this._writeStream.write(chunk.toString());
    done();
  }
}

export default new Log('info', new LogStream);
