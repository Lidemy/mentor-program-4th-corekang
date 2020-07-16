const request = require('../../../../../npm/node_modules/request');

request(
  'https://lidemy-book-store.herokuapp.com/books?_limit=10', // 取出前10筆
  (error, response, body) => {
    // console.log(body);
    const result = JSON.parse(body);
    // console.log(result);
    // console.log(result.length);

    for (let i = 0; i < result.length; i += 1) {
      console.log(`${result[i].id} ${result[i].name}`);
      // console.log(`${result[i].id} + ${result[i].name}`);
    }
  },
);
