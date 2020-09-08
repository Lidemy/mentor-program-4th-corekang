// 抽獎串接 API（函式版）
window.onload = () => {
  const apiUrl = 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery';
  const errorMessage = '系統不穩定，請再試一次';

  // 抽獎函式
  // 說明：抽獎後回傳資料（callbackfunction），當途中錯誤就傳入第 1 個參數後回傳，沒有錯誤就將資料傳入第 2 個參數、第 1 個參數則為 null 後回傳
  // 語法參考：http://youmightnotneedjquery.com/ > JSON
  function raffle(callbackfunction) {
    const xhr = new XMLHttpRequest();
    // return callbackfunction ('Error'); // 測試是否正確處理錯誤狀態

    xhr.open('GET', apiUrl, true); // true：非同步
    xhr.onload = () => {
      if (xhr.status >= 200 && xhr.status < 400) { // 發送成功
        // 錯誤處理 1：先測試 data，是否回傳非 JSON 格式物件（JSON.parse() 可能出錯）
        let data;
        try {
          data = JSON.parse(xhr.response);
        } catch (err) { // 如果發生錯誤
          callbackfunction(errorMessage); // eslint-disable-line no-alert
          return;
        }

        // 錯誤處理 2：資料沒有 prize
        if (!data.prize) {
          callbackfunction(errorMessage); // eslint-disable-line no-alert
          return;
        }

        callbackfunction(null, data); // 沒有錯誤（!null）時回傳 data
      }
    };

    // 錯誤處理 3：status 200-300 之外
    xhr.onerror = () => {
      callbackfunction(errorMessage); // eslint-disable-line no-alert
    };

    xhr.send();
    // 以上錯誤處理通常由後端處理
  }

  document
    .querySelector('.raffle-content-btn')
    .addEventListener('click', () => {
      // alert(1) // 確定成功新增監聽事件

      raffle((err, data) => {
        if (err) {
          alert(err); // eslint-disable-line no-alert
          return;
        }

        // 取得回應資料 JSON 格式物件 { prize: "獎項名稱" }
        // 設定檔
        const prizes = {
          FIRST: {
            className: 'first-prize',
            title: '恭喜你中頭獎了！日本東京來回雙人遊！',
          },
          SECOND: {
            className: 'second-prize',
            title: '貳獎！90 吋電視1台！',
          },
          THIRD: {
            className: 'third-prize',
            title: '恭喜你抽中參獎：知名 YouTuber 簽名握手會入場券1張，bang！',
          },
          NONE: {
            className: 'none-prize',
            title: '銘謝惠顧',
          },
        };

        // const className = prizes[data.prize].className;
        // const title = prizes[data.prize].title;
        const { className, title } = prizes[data.prize]; // 解構語法

        document.querySelector('.raffle').classList.add(className);
        document.querySelector('.raffle-result-title').innerText = title;
        document.querySelector('.raffle-content').classList.add('hide');
        document.querySelector('.raffle-result').classList.remove('hide');
      });
    });
};
