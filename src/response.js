function fixXml(xml) {
  if (typeof xml === 'object' && Object.prototype.toString.call(xml) === '[object Array]') {
    if (xml.length === 1 && typeof xml[0] === 'string') return xml[0];
    let returnValue = [];
    for (let i = 0, len = xml.length; i < len; ++i) {
      returnValue.push(fixXml(xml[i]));
    }
    return returnValue;
  } else if (typeof xml === 'object') {
    let returnValue = {};
    for (let prop in xml) {
      if (xml.hasOwnProperty(prop)) {
        returnValue[prop] = fixXml(xml[prop]);
      }
    }
    return returnValue;
  }
  return xml;
}

export default function Response(response) {
  return fixXml(response);
}
