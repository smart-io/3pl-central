import { createStore, combineReducers } from 'redux';
import orders from './orders/ordersReducers';

export const store = createStore(combineReducers({ orders }));
