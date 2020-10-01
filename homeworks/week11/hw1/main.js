// step 15-7：點擊後才顯示修改暱稱表單
window.onload = () => { // eslint-disable-line func-names
  const btn = document.querySelector('.board-btn-update');

  btn.addEventListener('click', () => {
    const form = document.querySelector('.board-form-update');
    // console.log(form); // 點擊是否抓到表單
    form.classList.toggle('hide'); // 收合表單
  });
};
