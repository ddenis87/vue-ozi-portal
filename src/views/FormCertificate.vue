<template>
  <div class="form-certificate" @keydown="onFormFilling">
    <v-card max-width="800" class="form-card">
      <v-form ref="CertificateData">
        <v-container>
          <v-row>
            <v-col cols="12">
              <h3 class="form-subtitle">Форма предоставления сведений на изготовление УКЭП</h3>
            </v-col>
          </v-row>
          <v-row dense>
            <v-col cols="12">
              <v-text-field dense
                            label="ФИО"
                            v-model="userData.fio"
                            :rules="[rulesRequired]"></v-text-field>
            </v-col>
          </v-row>
          <h4 class="form-subtitle">Паспортные данные</h4>
          <v-row dense>
            <v-col cols="2">
              <v-text-field dense
                            label="Серия"
                            v-mask="'####'"
                            v-model="userData.pSeria"
                            :rules="[
                              rulesRequired,
                              checkLengthValue(userData.pSeria, 4, 'Серия 4 символа'),
                            ]"></v-text-field>
            </v-col>
            <v-col cols="2"></v-col>
            <v-col cols="2">
              <v-text-field dense
                            label="Номер"
                            v-mask="'######'"
                            v-model="userData.pNumber"
                            :rules="[
                              rulesRequired,
                              checkLengthValue(userData.pNumber, 6, 'Номер 6 символов'),
                            ]"></v-text-field>
            </v-col>
          </v-row>
          <v-row dense>
            <v-col cols="3">
              <v-text-field dense
                            label="Дата выдачи"
                            type="date"
                            v-model="userData.pDate"
                            :rules="[rulesRequired]"></v-text-field>
            </v-col>
            <v-col cols="1"></v-col>
            <v-col cols="3">
              <v-text-field dense
                            label="Код подразделения"
                            v-mask="'###-###'"
                            v-model="userData.pKod"
                            :rules="[
                              rulesRequired,
                              checkLengthValue(userData.pKod, 7, 'Код 6 символов'),
                            ]"></v-text-field>
            </v-col>
          </v-row>
          <v-row dense>
            <v-col cols="12">
              <v-text-field dense
                            label="Кем выдан"
                            v-model="userData.pWho"
                            :rules="[rulesRequired]"></v-text-field>
            </v-col>
          </v-row>
          <v-row dense>
            <v-col cols="3">
              <v-text-field dense
                            label="Дата рождения"
                            type="date"
                            v-model="userData.pDateBirth"
                            :rules="[rulesRequired]"></v-text-field>
            </v-col>
          </v-row>
          <v-row dense>
            <v-col cols="12">
              <v-text-field dense
                            label="Место рождение"
                            v-model="userData.pPlaceBirth"
                            :rules="[rulesRequired]"></v-text-field>
            </v-col>
          </v-row>
          <h4 class="form-subtitle">Иные сведения</h4>
          <v-row dense>
            <v-col cols="3">
              <v-text-field dense
                            label="СНИЛС"
                            v-mask="'###-###-### ##'"
                            v-model="userData.oSNILS"
                            :rules="[
                              rulesRequired,
                              checkLengthValue(userData.oSNILS, 14, 'СНИЛС 11 символов'),
                            ]"></v-text-field>
            </v-col>
            <v-col cols="1"></v-col>
            <v-col cols="3">
              <v-text-field dense
                            label="ИНН"
                            v-mask="'############'"
                            v-model="userData.oINN"
                            :rules="[
                              rulesRequired,
                              checkLengthValue(userData.oINN, 12, 'ИНН 12 символов'),
                            ]"></v-text-field>
            </v-col>
          </v-row>
          <v-row dense height="40">
            <v-col cols="4">
              <v-text-field dense
                            label="Адрес электронной почты"
                            messages="Допускается указание почтового ящика начальника отдела/группы"
                            :rules="[rulesRequired]"
                            v-model="userData.oEmail"></v-text-field>
            </v-col>
          </v-row>
          <p class="form-note font-weight-regular font-italic">
            *Все поля являются обязательными для заполнения.
          </p>
          <v-row dense
                 class="form-control">
            <v-col cols="12">
              <div class="form-control__item">
                <v-btn dark
                       small
                       height="22"
                       color="blue darken-3"
                       @click="onClearForm">Очистить</v-btn>
                <v-btn :dark="!isDisabledSend"
                       small
                       height="22"
                       color="blue darken-3"
                       :disabled="isDisabledSend"
                       @click="onSendForm">Подать сведения</v-btn>
              </div>
            </v-col>
          </v-row>
        </v-container>
      </v-form>
    </v-card>
  </div>
</template>

<script>
import apiDB from '../api/apiDB';

export default {
  name: 'FormCertificate',
  data() {
    return {
      rulesRequired: (v) => !!v || 'Поле не заполнено',
      userData: {
        fio: '',
        pSeria: '',
        pNumber: '',
        pDate: '',
        pKod: '',
        pWho: '',
        pDateBirth: '',
        pPlaceBirth: '',
        oSNILS: '',
        oINN: '',
        oEmail: '',
      },
      isDisabledSend: true,
    };
  },
  methods: {
    checkLengthValue(v, length, title) {
      return v.length === length || title;
    },
    onClearForm() {
      this.$refs.CertificateData.reset();
    },
    onSendForm() {
      const sendForm = {
        snils: this.userData.oSNILS,
        userData: JSON.stringify(this.userData),
      };
      apiDB.sendForm(sendForm);
      // if (this.$refs.CertificateData.validate()) {
      // }
    },
    onFormFilling() {
      if (this.$refs.CertificateData.validate()) {
        this.isDisabledSend = false;
      } else {
        this.$refs.CertificateData.resetValidation();
        this.isDisabledSend = true;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.form-card {
  padding-left: 10px;
  padding-right: 40px;
}
.form-subtitle {
  margin: 15px 0;
  color: rgba(0, 0, 0, .8);
}
.form-note {
  padding: 0px 10px;
  padding-top: 30px;
  color: #E53935;
}
.form-control {
  &__item {
    padding-bottom: 25px;
    display: flex;
    justify-content: space-between;
  }
}
</style>
