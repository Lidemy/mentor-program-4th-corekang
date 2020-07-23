const request = require('request');

const args = process.argv;
const apiEndpoint = 'https://restcountries.eu/rest/v2';
const name = args[2]; // alpha2Code

// 測試資料
// const name = 'Taiwan';
// const name = 'United Kingdom of Great Britain and Northern Ireland';

request(
  `${apiEndpoint}/name/${name}`, // https://restcountries.eu/rest/v2/name/{name}
  (error, response, body) => {
    const result = JSON.parse(body);

    // 此 if 判斷式 從 request 上方移入，因為 Parsing error: 'return' outside of function
    // eslint-disable-next-line 無法忽略 Parsing error
    // 測試結果正確，還不確定是否邏輯錯誤
    if (!name) {
      console.log('輸入國家名稱');
      return;
    }

    if (error) {
      console.log('讀取失敗', error);
      return;
    }

    if (result.status === 404) {
      console.log('找不到國家資訊');
      return;
    }

    for (let i = 0; i < result.length; i += 1) {
      console.log('============');
      console.log(`國家：${result[i].name}`); // 字串
      console.log(`首都：${result[i].capital}`); // 字串
      console.log(`貨幣：${result[i].currencies[0].code}`); // 物件
      console.log(`國碼：${result[i].callingCodes[0]}`); // 陣列
      /*
      console.log('國家：' + result[i].name); // 字串
      console.log('首都：' + result[i].capital); // 字串
      console.log('貨幣：' + result[i].currencies[0].code); // 物件
      console.log('國碼：' + result[i].callingCodes[0]); // 陣列
      */
    }
  },
);
