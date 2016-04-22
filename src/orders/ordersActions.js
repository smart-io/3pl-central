export const CREATE_ORDER = 'CREATE_ORDER';
export const UPDATE_ORDER = 'UPDATE_ORDER';

export const createOrder = order => {
  return { type: CREATE_ORDER, order }
};

export const updateOrder = order => {
  return { type: UPDATE_ORDER, order }
};
