// 抽獎串接 API（無函式版）
window.onload = () => {
  const apiUrl = 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery';
  const errorMessage = '系統不穩定，請再試一次';

  document
    .querySelector('.raffle-content-btn')
    .addEventListener('click', () => {
      // alert(1) // 確定成功新增監聽事件

      // 抽獎串接 API
      // 語法參考：http://youmightnotneedjquery.com/ > JSON
      const xhr = new XMLHttpRequest();
      xhr.open('GET', apiUrl, true); // true：非同步
      xhr.onload = () => {
        if (xhr.status >= 200 && xhr.status < 400) { // 代表成功
          // 錯誤處理 1：先測試 data，是否回傳非 JSON 格式物件（JSON.parse() 可能出錯）
          let data;
          try {
            data = JSON.parse(xhr.response);
          } catch (err) { // 如果發生錯誤
            alert(errorMessage); // eslint-disable-line no-alert
            console.log(err);
            return;
          }

          // 錯誤處理 2：資料沒有 prize
          if (!data.prize) {
            alert(errorMessage); // eslint-disable-line no-alert
            return;
          }

          // 取得回應資料 JSON 格式物件 { prize: "獎項名稱" }
          let className;
          let title;
          if (data.prize === 'FIRST') {
            className = 'first-prize';
            title = '恭喜你中頭獎了！日本東京來回雙人遊！';
          } else if (data.prize === 'SECOND') {
            className = 'second-prize';
            title = '貳獎！90 吋電視1台！';
          } else if (data.prize === 'THIRD') {
            className = 'third-prize';
            title = '恭喜你抽中參獎：知名 YouTuber 簽名握手會入場券1張，bang！';
          } else if (data.prize === 'NONE') {
            className = 'none-prize';
            title = '銘謝惠顧';
          }
          document.querySelector('.raffle').classList.add(className);
          document.querySelector('.raffle-result-title').innerText = title;
          document.querySelector('.raffle-content').classList.add('hide');
          document.querySelector('.raffle-result').classList.remove('hide');
        }
      };

      // 錯誤處理 3：status 200-300 之外
      xhr.onerror = () => {
        alert(errorMessage); // eslint-disable-line no-alert
      };

      xhr.send();

      // 以上錯誤處理通常由後端處理
    });
};
