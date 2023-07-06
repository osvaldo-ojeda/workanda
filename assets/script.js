const formRegister = document.querySelector("#formRegister");
const nameInput = document.querySelector("#name");
const lastnameInput = document.querySelector("#lastname");
const emailinput = document.querySelector("#email");
const passwordInput = document.querySelector("#password");

const nameSpanInput = document.querySelector("#nameSpanInput");
const lastNnameSpanInput = document.querySelector("#lastNnameSpanInput");
const emailSpanInput = document.querySelector("#emailSpanInput");
const passwordSpanInput = document.querySelector("#passwordSpanInput");

const validateGeneralInput = (span, e) => {
  let fieldValue = e.target;
  let nameRex = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/g;
  if (fieldValue.value.trim().length < 2) {
    span.classList.remove("noDangerSpan");
    span.textContent = `El ${fieldValue.placeholder} es muy corto`;
    span.classList.add("dangerSpan");
  } else if (!nameRex.test(fieldValue.value)) {
    span.classList.remove("noDangerSpan");
    span.textContent = `El ${fieldValue.placeholder}, solo puede contener letras`;
    span.classList.add("dangerSpan");
  } else {
    span.classList.remove("dangerSpan");
    span.textContent = "";
    span.classList.add("noDangerSpan");
  }
};

const validateEmailInput = (span, e) => {
  let fieldValue = e.target;
  let emailRex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/g;

  if (fieldValue.value.trim() === "") {
    span.classList.remove("noDangerSpan");
    span.textContent = `El ${fieldValue.placeholder} no puede estar vacío`;
    span.classList.add("dangerSpan");
  } else if (!emailRex.test(fieldValue.value)) {
    span.classList.remove("noDangerSpan");
    span.textContent = `El ${fieldValue.placeholder} debe tener un formato válido de correo electrónico (ejemplo@dominio.com)`;
    span.classList.add("dangerSpan");
  } else {
    span.classList.remove("dangerSpan");
    span.textContent = "";
    span.classList.add("noDangerSpan");
  }
};

const validatePasswordInput = (span, e) => {
  let fieldValue = e.target;
  let passwordRex = /^[^\s]{4,8}$/g;

  if (fieldValue.value.trim() === "") {
    span.classList.remove("noDangerSpan");
    span.textContent = `La ${fieldValue.placeholder} no puede estar vacía`;
    span.classList.add("dangerSpan");
  } else if (!passwordRex.test(fieldValue.value)) {
    span.classList.remove("noDangerSpan");
    span.textContent = `La ${fieldValue.placeholder} debe tener entre 4 y 8 caracteres`;
    span.classList.add("dangerSpan");
  } else {
    span.classList.remove("dangerSpan");
    span.textContent = "";
    span.classList.add("noDangerSpan");
  }
};

const noDangerClassRemove = (span, e) => {
  span.classList.remove("dangerSpan");
  span.classList.add("noDangerSpan");
};

nameInput.onblur = (e) => validateGeneralInput(nameSpanInput, e);
lastnameInput.onblur = (e) => validateGeneralInput(lastNnameSpanInput, e);
emailinput.onblur = (e) => validateEmailInput(emailSpanInput, e);
passwordInput.onblur = (e) => validatePasswordInput(passwordSpanInput, e);

nameInput.onfocus = (e) => noDangerClassRemove(nameSpanInput, e);
lastnameInput.onfocus = (e) => noDangerClassRemove(lastNnameSpanInput, e);
emailinput.onfocus = (e) => noDangerClassRemove(emailSpanInput, e);
passwordInput.onfocus = (e) => noDangerClassRemove(passwordSpanInput, e);

formRegister.onsubmit = (e) => {
  e.preventDefault();

  let nameRex = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/g;
  let emailRex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/g;
  let passwordRex = /^[^\s]{4,8}$/g;

  if (nameInput.value.trim().length < 2 || !nameInput.value.match(nameRex)) {
    nameSpanInput.classList.remove("noDangerSpan");
    nameSpanInput.textContent = `Datos incorrectos`;
    nameSpanInput.classList.add("dangerSpan");
  } else if (
    lastnameInput.value.trim().length < 2 ||
    !lastnameInput.value.match(nameRex)
  ) {
    lastNnameSpanInput.classList.remove("noDangerSpan");
    lastNnameSpanInput.textContent = `Datos incorrectos`;
    lastNnameSpanInput.classList.add("dangerSpan");
  } else if (
    emailinput.value.trim().length == 0 ||
    !emailinput.value.match(emailRex)
  ) {
    emailSpanInput.classList.remove("noDangerSpan");
    emailSpanInput.textContent = `Datos incorrectos`;
    emailSpanInput.classList.add("dangerSpan");
  } else if (
    passwordInput.value.trim().length == 0 ||
    !passwordInput.value.match(passwordRex)
  ) {
    passwordSpanInput.classList.remove("noDangerSpan");
    passwordSpanInput.textContent = `Datos incorrectos`;
    passwordSpanInput.classList.add("dangerSpan");
  } else {
    e.currentTarget.submit();
  }
};
