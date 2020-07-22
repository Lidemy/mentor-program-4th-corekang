const request = require('request');

const clientID = 'o7o8yzev4v3zd2wm60m8nvlp0pfqly';
const rootURL = 'https://api.twitch.tv/kraken'; // Root URL

request({
  method: 'GET',
  url: `${rootURL}/games/top`,
  headers: {
    'Client-ID': clientID,
    'Accept': 'application/vnd.twitchtv.v5+json', /* eslint quote-props: 0 */ // Unnecessarily quoted property 'Accept' found
  },
}, (error, response, body) => {
  if (error) {
    console.log(error);
    return;
  }
  const info = JSON.parse(body);
  const top2 = info.top;
  // eslint-disable-next-line
  for (let game of top2) { // 單純迭代陣列時，使用 for...of輸出的是值
    console.log(`${game.viewers}  ${game.game.name}`);
  }
});
