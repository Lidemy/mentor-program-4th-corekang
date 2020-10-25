/* eslint-disable no-use-before-define, arrow-body-style */

window.onload = () => {
  const apiUrl = 'https://api.twitch.tv/kraken';
  const clientID = 'o7o8yzev4v3zd2wm60m8nvlp0pfqly';
  const accept = 'application/vnd.twitchtv.v5+json';
  const streamTemplate = `
    <div class="stream">
      <img src="$preview">
      <div class="stream-data">
        <div class="stream-avatar">
          <img scr="$logo">
        </div>
        <div class="stream-intro">
          <div class="stream-title">$title</div>
          <div class="stream-channel">$name</div>
        </div>
      </div>
    </div>
  `;

  // Only get games data
  getGames((games) => {
    for (const game of games) { // eslint-disable-line no-restricted-syntax
      const element = document.createElement('li');

      element.innerText = game; // v2: game.game.name
      document.querySelector('.header-topnav').appendChild(element);
    }
    // Display first game name: click first game
    changeGame(games[0]); // v2: games[0].game.name
  });

  // Click menu to change web title and reload game video
  document.querySelector('.header-topnav').addEventListener('click', (e) => {
    if (e.target.tagName.toLowerCase() === 'li') {
      const gameName = e.target.innerText;

      changeGame(gameName);
    }
  });

  // Use fetch
  function getGames(callback) {
    fetch(`${apiUrl}/games/top?limit=5`, {
      method: 'GET',
      headers: new Headers({
        'Client-ID': clientID,
        Accept: accept,
      }),
    }).then((response) => { // ESlint suggestion: Omit { return }
      return response.json();
    }).then((json) => {
      const games = json.top.map(game => game.game.name); // v2: JSON.parse(request.response).top
      callback(games);
    }).catch((err) => {
      console.log('Error', err);
    });
  }

  function changeGame(gameName) {
    // Click menu to change web title
    document.querySelector('h1').innerText = gameName;
    // Click menu to clear video and reload video
    document.querySelector('.main-stream').innerHTML = '';
    getStreams(gameName, (streams) => {
      for (const stream of streams) { // eslint-disable-line no-restricted-syntax
        appendStream(stream);
      }
    });
  }

  function appendStream(stream) {
    const element = document.createElement('div');

    document.querySelector('.main-stream').appendChild(element);
    element.outerHTML = streamTemplate
      .replace('$preview', stream.preview.large)
      .replace('$logo', stream.channel.logo)
      .replace('$title', stream.channel.status)
      .replace('$name', stream.channel.name);
  }

  // Click menu & reload games: use fetch
  function getStreams(gameName, callback) {
    fetch(`${apiUrl}/streams?game=${encodeURIComponent(gameName)}`, {
      method: 'GET',
      headers: new Headers({
        'Client-ID': clientID,
        Accept: accept,
      }),
    }).then((response) => {
      return response.json(); // ESlint suggestion: Omit { return }
    }).then((json) => {
      callback(json.streams); // v2: JSON.parse(request.response).streams
    }).catch((err) => {
      console.log('Error', err);
    });
  }
};
