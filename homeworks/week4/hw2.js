const request = require('request');

const args = process.argv; // 取得陣列參數
const apiEndpoint = 'https://lidemy-book-store.herokuapp.com'; // 網址結尾多/則無效
const action = args[2];
const param = args[3];

/* eslint no-use-before-define: 0 */
// switch(action)：action === 'list'，執行 listBook()。
switch (action) {
  case 'list':
    listBook();
    break;
  case 'read':
    readBook(param);
    break;
  case 'delete':
    deleteBook(param);
    break;
  case 'create':
    createBook(param);
    break;
  case 'update':
    updateBook(param, args[4]);
    break;
  default:
    console.log('Successful: list, read, delete, create, update.');
}


// 印出前 20 本書的 id 與書名：list
function listBook() {
  request.get(
    `${apiEndpoint}/books?_limit=30`,
    (error, body) => {
      if (error) {
        console.log('讀取失敗', error);
        return;
      }
      const result = JSON.parse(body);
      for (let i = 0; i < result.length; i += 1) {
        console.log(`${result[i].id}  ${result[i].name}`);
      }
    },
  );
}

// listBook();
/*
1  克雷的橋
2  當我想你時，全世界都救不了我
3  我殺的人與殺我的人
4  念念時光真味
5  蜂蜜花火【致年少時光‧限量插畫設計書衣典藏版】
6  苦雨之地
7  你已走遠，我還在練習道別
8  想把餘生的溫柔都給你
9  你是我最熟悉的陌生人
10  偷書賊（25萬本紀念版本）
11  在回憶消逝之前
12  懲罰
13  雲邊有個小賣部
14  颶光典籍三部曲：引誓之劍（上下冊套書）
15  危險維納斯
16  大旱
17  最後的再見
18  解憂雜貨店【暢銷35萬冊暖心紀念版】：回饋讀者，一次收藏2款書封！
19  高山上的小郵局：獻給書信和手寫年代的溫暖情詩，2019年最治癒人心的高暖度小說
20  在場證明
21  I love coding
22  undefined
*/


// 輸出 id 為 1 的書籍：read 1
function readBook(id) {
  request.get(
    `${apiEndpoint}/books/${id}`,
    (error, body) => {
      if (error) {
        console.log(`讀取失敗  ${error}`);
        return;
      }
      const result = JSON.parse(body);
      console.log(result);
    },
  );
}

// readBook(1); // { id: 1, name: '克雷的橋'}


// 刪除 id 為 1 的書籍：delete 1
function deleteBook(id) {
  request.delete(
    `${apiEndpoint}/books/${id}`,
    (error) => {
      if (error) {
        console.log(`刪除失敗  ${error}`);
        return;
      }
      console.log(`${id}  刪除成功`);
    },
  );
}

// deleteBook(19);


// 新增一本名為 I love coding 的書：create "I love coding"
function createBook(name) {
  request.post({
    url: `${apiEndpoint}/books`,
    form: {
      name,
    },
  }, (error) => {
    if (error) {
      console.log(`新增失敗  ${error}`);
      return;
    }
    console.log(`${name}  新增成功！`);
  });
}

// createBook(`I love coding`);


// 更新 id 為 1 的書名為 new name：update 1 "new name"
function updateBook(id, name) {
  request.patch({
    url: `${apiEndpoint}/books/${id}`,
    form: {
      name,
    },
  }, (error) => {
    if (error) {
      console.log(`更新失敗  ${error}`);
      return;
    }
    console.log(`${id}  更新成功`);
  });
}

// updateBook(24, '個人實相的本質');
