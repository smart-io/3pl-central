import fs from 'fs';
import fetch from 'isomorphic-fetch';
import xml2js from 'xml2js';
import Response from './response';

class Request {
  constructor(method, url, contentFile) {
    this.method = method;
    this.url = url;
    this.contentFile = contentFile;
  }

  fetch(data) {
    return new Promise((resolve, reject) => {
      this.readContentFile()
        .then((content) => this.replaceContentData(content, data))
        .then((content) => {
          fetch('https://secure-wms.com/webserviceexternal/contracts.asmx', {
            method: 'post',
            headers: {
              'SOAPAction': this.url,
              'Content-Type': 'text/xml; charset=utf-8'
            },
            body: content
          })
            .then(function(response) {
              if (response.status >= 400) return reject();
              return response.text();
            })
            .then(this.parseResponse)
            .then((response) => resolve(new Response(response)));
        });
    });
  }

  readContentFile() {
    return new Promise((resolve, reject) => {
      fs.readFile(this.contentFile, 'utf8', (err, data) => {
        if (err) return reject(err);
        resolve(data);
      });
    });
  }

  replaceContentData(content, data) {
    data = {
      ...data,
      ThreePLID: process.env.THREEPL_ID,
      Login: process.env.THREEPL_LOGIN,
      Password: process.env.THREEPL_PASSWORD,
      CustomerID: process.env.THREEPL_CUSTOMERID,
      FacilityID: process.env.THREEPL_FACILITYID
    };

    for (let prop in data) {
      if (data.hasOwnProperty(prop)) {
        content = content.replace(`{${prop}}`, data[prop]);
      }
    }
    return content;
  }

  parseResponse = (response) => {
    return new Promise((resolve, reject) => {
      xml2js.parseString(response, (err, result) => {
        if (err) return reject(err);
        let response = {};
        const body = result['soap:Envelope']['soap:Body'][0];
        let asyncCalls = 0;
        for (let prop in body) {
          if (body.hasOwnProperty(prop)) {
            asyncCalls++;
            this.parseXml(body[prop][0]['_']).then((xml) => {
              asyncCalls--;
              response[prop] = xml;
              if (asyncCalls === 0) resolve(response);
            });
          }
        }
      });
    });
  };

  parseXml(content) {
    return new Promise(function(resolve, reject) {
      if (content.indexOf('<') === -1) resolve(content);

      xml2js.parseString(content, (err, result) => {
        if (err) return reject();
        resolve(result);
      });
    });
  }
}

export default Request;
