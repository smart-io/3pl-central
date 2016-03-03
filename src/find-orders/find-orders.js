import path from 'path';
import moment from 'moment';
import Request from '../request';

export default function(beginDate, endDate) {
  return new Promise(function(resolve, reject) {
    if (!endDate) endDate = moment();
    if (typeof beginDate === 'string') beginDate = moment(beginDate);
    if (typeof endDate === 'string') endDate = moment(endDate);
    new Request(
      'POST',
      'http://www.JOI.com/schemas/ViaSub.WMS/FindOrders',
      path.join(__dirname, 'find-orders.xml')
    )
      .fetch({
        BeginDate: beginDate.format('YYYY-MM-DD'),
        EndDate: endDate.format('YYYY-MM-DD')
      })
      .then((response) => {
        resolve(response['FindOrders']['orders']['order']);
      })
      .catch(reject);
  });
}
