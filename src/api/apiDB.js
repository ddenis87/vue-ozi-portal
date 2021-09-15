import axios from 'axios';

const pathDB = 'http://ozi_portal.0038.pfr.ru/indexDB.php';

export default {
  sendForm(form) {
    const sendForm = { ...form, function: 'sendUserData' };
    axios
      .post(pathDB, null, { params: sendForm })
      .then((res) => {
        console.log(res);
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
