import { expect } from 'chai';
import { findOrders } from '../../src/index';

describe('API', () => {
  it('should be exported', () => {
    expect(findOrders).to.exist;
  });
});
