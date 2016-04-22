import mongodb from 'mongodb';

let connection;

export function connect() {
  return new Promise((resolve, reject) => {
    if (connection) return resolve(connection);
    mongodb.MongoClient.connect('mongodb://localhost:27017/3pl-central', function(err, db) {
      connection = db;
      resolve(db);
    });
  });
}

export function close() {
  connection.close();
}
