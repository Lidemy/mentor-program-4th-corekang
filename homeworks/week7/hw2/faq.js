window.onload = () => {
  document
    .querySelector('.section__faq')
    .addEventListener('click', (e) => {
      /* 只對標題作用 */
      /*
      if (e.target.tagName.toLowerCase() === 'h2') {
        e.target.parentNode.parentNode.classList.toggle('section__faq-item--hide');
      }
      */
      /* 點擊 <div class="section__faq"> 本身無作用 */
      /*
      e.target.closest('.section__faq-item').classList.toggle('section__faq-item--hide');
      */
      /* 確保找到物件 */
      /* const element = e.target.closest('.section__faq-item'); */
      /* 套用函式 */
      const element = closest(e.target, 'section__faq-item'); // eslint-disable-line no-use-before-define
      if (element) {
        element.classList.toggle('section__faq-item--hide');
      }
    });
};

/* 老師實作函式 closest（老師比較喜歡此版本） */
function closest(node, className) { // eslint-disable-line consistent-return
  while (node && node.classList) {
    if (node.classList.contains(className)) {
      return node;
    }
    node = node.parentNode; // eslint-disable-line no-param-reassign
  }
}

/* eslint-disable*/
/* 老師實作函式 closest 遞迴版本：如果沒有 node 或沒有 node.classList，代表找到 document 還是沒有這個元素；如果符合條件，回傳 node；否則往 node.parentNode 找，一直呼叫一直呼叫 */

function closestRecursive(node, className) { // eslint-disable-line no-unused-vars
  if (!node || !node.classList) return null;
  if (node.classList.contains(className)) {
    return node;
  }
  return closestRecursive(node.parentNode, className);
}
