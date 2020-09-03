window.onload = () => {
  document
    .querySelector('.todolist-input')
    .addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        // code for enter
        const value = document.querySelector('.todolist-input').value; // eslint-disable-line prefer-destructuring
        if (!value) return;
        const div = document.createElement('div');
        div.classList.add('todolist-single');
        /* eslint-disable no-use-before-define */
        div.innerHTML = `
          <label class="todolist-label">
            <input class="todolist-check" type="checkbox" />
            <span class="todolist-checkbox-custom"></span>
          </label>
          <div class="todolist-content">${escapeHtml(value)}</div>
          <button class="btn btn-delete" type="button">
            <span class="ri-cross"></span>
          </button>
        `;
        document.querySelector('.todolist-block').appendChild(div);
        document.querySelector('.todolist-input').value = '';
      }
    });
  // 前一版
  /*
  document
    .querySelector('.btn-create')
    .addEventListener('click', () => {
      const value = document.querySelector('.todolist-input').value;
      if (!value) return;
      const div = document.createElement('div');
      div.classList.add('todolist-single');
      div.innerHTML = `
        <label class="todolist-label">
          <input class="todolist-check" type="checkbox" />
          <span class="todolist-checkbox-custom"></span>
        </label>
        <div class="todolist-content">${escapeHtml(value)}</div>
        <button class="btn btn-delete" type="button">
          <span class="ri-cross"></span>
        </button>
      `
      document.querySelector('.todolist-block').appendChild(div);
      document.querySelector('.todolist-input').value = '';
    })
  */

  // event delegation / proxy：透過共同 parent 偵測底下元素行為，適用於動態元素，否則執行當下沒有元素，無法取得元素，即無法addEventListener
  document
    .querySelector('.todolist-block')
    .addEventListener('click', (e) => {
      const { target } = e;
      // delete todolist
      if (target.classList.contains('ri-cross')) { // 前一版：btn-delete
        target.parentNode.parentNode.remove();
        return;
      }
      // checked/unchecked todolist
      if (target.classList.contains('todolist-check')) {
        // console.log(target.checked);
        if (target.checked) {
          target.parentNode.parentNode.classList.add('todolist-done');
        } else {
          target.parentNode.parentNode.classList.remove('todolist-done');
        }
      }
    });
};

/* eslint-disable */
/* appendChild運作：例如新增<div class="todolist-block2">，ocument.querySelector(".todolist-block").appendChild(div)下增加ocument.querySelector(".todolist-block2").appendChild(div)，新增後卻只有一筆，且新增於class="todolist-block2"，MDN文件解釋：使用appendChild，於相同節點（createElement創造的節點，稱為node，與Node.js的node不同），將進行移動而非複製一份，呼叫第二次時，將第一個div移至class="todolist-block2"，若想新建可使用cloneElement() */

/* 與網路安全相關，第11、12週課程提及 */
function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}
