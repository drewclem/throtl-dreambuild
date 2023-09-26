import BaseApi from './BaseApi'

export default {
  checkEmail(email, companyId) {
    return BaseApi.post(`/${companyId}/check-email`, { email, companyId })
  }
}
