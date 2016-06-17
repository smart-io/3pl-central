import Client from './client';
import findOrdersImport from './findOrders/client';

export const client = new Client;
export const connect = client.connect;
export const listen = client.listen;
export const close = client.close;
export const on = client.on;
export const off = client.off;

export const findOrders = findOrdersImport;
