import * as ordersActions from './ordersActions';

export default function (state = [], action) {
  switch(action.type) {
  case ordersActions.CREATE_ORDER:
    let nextState = [];
    for (let i = 0, len = state.length; i < len; ++i) {
      nextState.push({ ...state[i] });
    }
    nextState.push({ ...action.order });
    return nextState;

  case ordersActions.UPDATE_ORDER:
    let nextState = [];
    let didMatch = false;
    for (let i = 0, len = state.length; i < len; ++i) {
      if (state[i].WarehouseTransactionID === action.order.WarehouseTransactionID) {
        didMatch = true;
        nextState.push({ ...action.order });
      } else {
        nextState.push({ ...state[i] });
      }
    }
    if (!didMatch) nextState.push({ ...action.order });
    return nextState;

  default:
    return state;
  }
};
