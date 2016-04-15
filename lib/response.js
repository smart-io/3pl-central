'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol ? "symbol" : typeof obj; };

exports.default = Response;
function fixXml(xml) {
  if ((typeof xml === 'undefined' ? 'undefined' : _typeof(xml)) === 'object' && Object.prototype.toString.call(xml) === '[object Array]') {
    if (xml.length === 1 && typeof xml[0] === 'string') return xml[0];
    var returnValue = [];
    for (var i = 0, len = xml.length; i < len; ++i) {
      returnValue.push(fixXml(xml[i]));
    }
    return returnValue;
  } else if ((typeof xml === 'undefined' ? 'undefined' : _typeof(xml)) === 'object') {
    var _returnValue = {};
    for (var prop in xml) {
      if (xml.hasOwnProperty(prop)) {
        _returnValue[prop] = fixXml(xml[prop]);
      }
    }
    return _returnValue;
  }
  return xml;
}

function Response(response) {
  return fixXml(response);
}