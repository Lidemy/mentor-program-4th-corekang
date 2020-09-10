window.onload = () => {
  const request = new XMLHttpRequest();
  const apiUrl = 'https://api.twitch.tv/kraken/games/top?limit=5';

  request.open('GET', apiUrl, true);

  // Twitch API 文件規定兩個 header：https://dev.twitch.tv/docs/v5
  request.setRequestHeader('Client-ID', 'o7o8yzev4v3zd2wm60m8nvlp0pfqly'); /* 個別申請 */
  request.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');

  request.onload = () => {
    if (request.status >= 200 && request.status < 400) {
      // console.log(request.response); // 確認取得資料
      const data = JSON.parse(request.response).top;
      // console.log(data); // 確認資料結構，於上一行加上所需資料 .top

      // 動態新增選單名稱 .header-topnav，迴圈取出每個元素
      // 方法 1：for (let i = 0; i < data.length; i += 1) { games[i]; ... }
      // 方法 2：迴圈用法之一：for of // for in：選取 key，for of：選取 value
      for (const games of data) { // eslint-disable-line no-restricted-syntax
        // console.log(games);
        const element = document.createElement('li');
        element.innerText = games.game.name;
        document.querySelector('.header-topnav').appendChild(element);
      }

      // 顯示第一個遊戲實況名稱
      document.querySelector('h1').innerText = data[0].game.name;

      // 抓取第一個遊戲實況內容
      // 每次發送 request 都要 new XMLHttpRequest()
      const request2 = new XMLHttpRequest();
      const apiUrl2 = `https://api.twitch.tv/kraken/streams?game=${encodeURIComponent(data[0].game.name)}`; // encodeURIComponent()：順利轉換中文或特殊字元

      request2.open('GET', apiUrl2, true);

      request2.setRequestHeader('Client-ID', 'o7o8yzev4v3zd2wm60m8nvlp0pfqly');
      request2.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');

      request2.onload = () => {
        if (request2.status >= 200 && request2.status < 400) {
          const data2 = JSON.parse(request2.response).streams;
          // console.log(data2); // 確認資料結構，於上一行加上所需資料 .streams

          // 動態新增選單名稱 .header-topnav，迴圈取出每個元素
          for (const streams of data2) { // eslint-disable-line no-restricted-syntax
            // console.log(strams);
            const element = document.createElement('div');
            document.querySelector('.main-stream').appendChild(element); // 此行前移，才能設定 outerHTML，因為必須先有 parent node
            element.outerHTML = `
            <div class="stream">
              <img src="${streams.preview.large}">
              <div class="stream-data">
                <div class="stream-avatar">
                  <img src="${streams.channel.logo}">
                </div>
                <div class="stream-intro">
                  <div class="stream-title">${streams.channel.status}</div>
                  <div class="stream-channel">${streams.channel.name}</div>
                </div>
              </div>
            </div>
            `;
          }
        }
      };

      request2.send();
    }
  };

  request.send();

  // 點擊選單改變網頁標題、重新抓取影片
  document.querySelector('.header-topnav').addEventListener('click', (e) => {
    // console.log(e.target); // 確認點擊目標
    if (e.target.tagName.toLowerCase() === 'li') {
      const gameName = e.target.innerText;

      // 點擊選單改變網頁標題
      document.querySelector('h1').innerText = gameName;

      // 點擊選單重新抓取影片前先清空影片
      document.querySelector('.main-stream').innerHTML = '';

      // 點擊選單重新抓取影片（變數生存範圍於函式，以下 request3 可使用 request2）
      const request3 = new XMLHttpRequest();
      const apiUrl3 = `https://api.twitch.tv/kraken/streams?game=${encodeURIComponent(gameName)}`; // 只須修改為 gmaeName

      request3.open('GET', apiUrl3, true);

      request3.setRequestHeader('Client-ID', 'o7o8yzev4v3zd2wm60m8nvlp0pfqly');
      request3.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');

      request3.onload = () => {
        if (request3.status >= 200 && request3.status < 400) {
          const data = JSON.parse(request3.response).streams;

          for (const streams of data) { // eslint-disable-line no-restricted-syntax
            // console.log(strams);
            const element = document.createElement('div');
            document.querySelector('.main-stream').appendChild(element);
            element.outerHTML = `
            <div class="stream">
              <img src="${streams.preview.large}">
              <div class="stream-data">
                <div class="stream-avatar">
                  <img scr="${streams.channel.logo}">
                </div>
                <div class="stream-intro">
                  <div class="stream-title">${streams.channel.status}</div>
                  <div class="stream-channel">${streams.channel.name}</div>
                </div>
              </div>
            </div>
            `;
          }
        }
      };

      request3.send();
    }
  });
};

// this.status => request.status => Chrome DevTools > Console 才能印出資料 > Network 確認取得資料
// 老師說明：箭頭函式與一般函式使用 this 不太一樣，可先改用一般函式，至於差別 16 週會提到
