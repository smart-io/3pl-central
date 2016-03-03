FROM node

RUN npm install

EXPOSE 10101

CMD npm run-script serve
