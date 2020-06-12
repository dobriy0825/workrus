import ajaxPost from "../../../common/ajaxPOST";
import hideVerifyPhone from "../../../common/hide_verify_phone";

export default async function () {
    let result = await ajaxPost('/cabinet/settings/do_not_change');
    hideVerifyPhone();
}
