import $ from 'jquery'; // eslint-disable-line import/no-unresolved

// Step 6：cursor-based id
export function getComments(apiUrl, siteKey, before, cb) {
  let url = `${apiUrl}/api_comments.php?site_key=${siteKey}`;

  if (before) {
    url += `&before=${before}`;
  }

  $.ajax({
    url,
  }).done((data) => {
    cb(data);
  });
}

export function addComments(apiUrl, siteKey, data, cb) {
  $.ajax({
    type: 'POST',
    url: `${apiUrl}/api_add_comments.php`,
    data,
  }).done((data) => { // eslint-disable-line no-shadow
    cb(data);
  });
}
