import { store } from './app';
import { Observable } from 'rxjs/Observable';

// todo use RX instead of Redux

export default function () {
  store.subscribe(() => {

  });
}

const createOrder$ = new Observable(observer => {
  let timeout = setTimeout(() => {
    observer.next('observable timout')
  }, 2000);

  return () => {
    clearTimeout(timeout);
    console.log('by bye');
  };
});

let disposable = createOrder$.subscribe(value => {
  console.log(value);
});

//createOrder$.publish();
