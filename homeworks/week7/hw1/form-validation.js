window.onload = () => {
  document.querySelector('form').addEventListener('submit', (e) => {
    e.preventDefault(); // 阻止預設事件
    let hasError = false;
    const enterValue = {};
    const element = document.querySelectorAll('.required');

    /* eslint-disable no-undef */
    for (elementCopy of element) { // eslint-disable-line no-restricted-syntax
      const input = elementCopy.querySelector('input[type=text]');
      const radio = elementCopy.querySelectorAll('input[type=radio]');
      let hasValue = true;

      if (input) {
        enterValue[input.name] = input.value;

        if (!input.value) {
          hasValue = false;
        }
      } else if (radio.length) {
        hasValue = [...radio].some(radio => radio.checked); // eslint-disable-line max-len, no-shadow
        if (hasValue) {
          const checkedRadio = elementCopy.querySelector('input[type=radio]:checked');
          enterValue[checkedRadio.name] = checkedRadio.value;
        }
      } else {
        continue; // eslint-disable-line no-continue
      }

      if (!hasValue) {
        elementCopy.classList.remove('hide-error');
        hasError = true;
      } else {
        elementCopy.classList.add('hide-error');
      }
    }

    if (!hasError) {
      alert(JSON.stringify(enterValue)); // eslint-disable-line no-alert
    }
  });
};
