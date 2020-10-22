/* eslint-disable max-len, no-shadow, no-alert, no-use-before-define, prefer-destructuring, prefer-const, arrow-parens */

import $ from 'jquery'; // eslint-disable-line import/no-unresolved
import { getComments, addComments } from './api';
import { appendStyle, appendCommentToDOM } from './utils';
import { cssTemplate, getForm, getLoadMoreButton } from './templates';

// Step 7：Initialized task, usage for initialized task see also reference
export default function init(options) {
  // Become local variable
  let siteKey = '';
  let apiUrl = '';
  let containerElement = null;
  let commentDOM = null;
  let lastId = null;
  let isEnd = false;
  let loadMoreClassName;
  let commentsClassName;
  let commentsSelector;
  let formClassName;
  let formSelector;

  siteKey = options.siteKey; // Get value from outside
  apiUrl = options.apiUrl;
  loadMoreClassName = `${siteKey}-load-more`;
  commentsClassName = `${siteKey}-comments`;
  formClassName = `${siteKey}-add-comment-form`;
  commentsSelector = `.${commentsClassName}`; // '.' + commentsClassName
  formSelector = `.${formClassName}`;

  containerElement = $(options.containerSelector);
  // console.log(containerElement);
  containerElement.append(getForm(formClassName, commentsClassName)); // formTemplate => getForm((formClassName, commentsClassName))
  appendStyle(cssTemplate);

  commentDOM = $(commentsSelector); // '.comments' => commentsSelector
  getNewComments();

  $(commentsSelector).on('click', `. ${loadMoreClassName}`, () => { // '.load-more' => '.' + loadMoreClassName
    getNewComments();
  });

  $(formSelector).submit(e => { // .form-add-comment => formSelector
    e.preventDefault();
    const nicknameDOM = $(`${formSelector} input[name=nickname]`); // 'input[name=nickname]'
    const contentDOM = $(`${formSelector} textarea[name=content]`); // 'textarea[name=content]'

    const newCommentData = {
      site_key: siteKey,
      nickname: nicknameDOM.val(),
      content: contentDOM.val(),
    };

    addComments(apiUrl, siteKey, newCommentData, data => {
      if (!data.ok) {
        alert(data.message);
        return;
      }
      nicknameDOM.val('');
      contentDOM.val('');

      appendCommentToDOM(commentDOM, newCommentData, true);
    });
  });

  function getNewComments() {
    const commentDOM = $(commentsSelector);

    $(`. ${loadMoreClassName}`).hide();

    if (isEnd) {
      return;
    }

    getComments(apiUrl, siteKey, lastId, data => {
      if (!data.ok) {
        alert(data.message);
        return;
      }

      const comments = data.comments; // huli: data.discussions;
      // console.log(data);

      for (const comment of comments) { // eslint-disable-line no-restricted-syntax
        appendCommentToDOM(commentDOM, comment);
      }

      const length = comments.length;

      if (length === 0) {
        isEnd = true;
        $(`. ${loadMoreClassName}`).hide();
      } else {
        lastId = comments[length - 1].id;
        const loadMoreButtonHTML = getLoadMoreButton(loadMoreClassName);
        $(commentsSelector).append(loadMoreButtonHTML);
      }
    });
  }
}
