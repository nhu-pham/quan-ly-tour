
document.addEventListener("DOMContentLoaded", () => {

    const tabThongTin = document.querySelector('[href="#tabTT"]');
    const tabMK = document.querySelector('[href="#tabMK"]');
    const tabDM = document.querySelector('[href="#tabDM"]');
    const tabKM = document.querySelector('[href="#tabKM"]');
    const tabYT = document.querySelector('[href="#tabYT"]');
        const tabDM_wait = document.querySelector('[href="#wait"]');
        const tabDM_all = document.querySelector('[href="#all"]');
        const tabDM_finish = document.querySelector('[href="#finish"]');
        const tabDM_cancel = document.querySelector('[href="#cancel"]');
    const thongTinTKSection = document.getElementById("thongTinTK");
    const doiMKSection = document.getElementById("doiMK");
    const donMuaSection = document.getElementById("donMua");
        const allOrderSection = document.getElementById("all-order");
        const waitPaySection = document.getElementById("waitforpay");
        const finishSection = document.getElementById("finish-order");
        const cancelSection = document.getElementById("cancel-order");
    const khuyenMaiSection = document.getElementById("khuyenMai");
    const yeuThichSection = document.getElementById("yeuThich");
    
tabThongTin.addEventListener('click', function(){
    tabThongTin.classList.add('active_tt'); // Thêm class "active" cho tab được chọn
    tabMK.classList.remove('active_tt'); 
    tabDM.classList.remove('active_tt');
    tabKM.classList.remove('active_tt');
    tabYT.classList.remove('active_tt');
    thongTinTKSection.style.display = 'block';
    yeuThichSection.style.display = 'none';
    doiMKSection.style.display = 'none';
    donMuaSection.style.display = 'none';
    khuyenMaiSection.style.display = 'none';
})
tabMK.addEventListener('click', function(){
    tabMK.classList.add('active_tt'); // Thêm class "active" cho tab được chọn
    tabThongTin.classList.remove('active_tt'); 
    tabDM.classList.remove('active_tt');
    tabKM.classList.remove('active_tt');
    tabYT.classList.remove('active_tt');
    doiMKSection.style.display = 'block';
    yeuThichSection.style.display = 'none';
    thongTinTKSection.style.display = 'none';
    donMuaSection.style.display = 'none';
    khuyenMaiSection.style.display = 'none';
})
tabDM.addEventListener('click', function(){
    tabDM.classList.add('active_tt'); // Thêm class "active" cho tab được chọn
    tabThongTin.classList.remove('active_tt'); 
    tabMK.classList.remove('active_tt');
    tabKM.classList.remove('active_tt');
    tabYT.classList.remove('active_tt');
    donMuaSection.style.display = 'block';
    yeuThichSection.style.display = 'none';
    doiMKSection.style.display = 'none';
    thongTinTKSection.style.display = 'none';
    khuyenMaiSection.style.display = 'none';
})
tabKM.addEventListener('click', function(){
    tabKM.classList.add('active_tt');
    tabDM.classList.remove('active_tt'); // Thêm class "active" cho tab được chọn
    tabThongTin.classList.remove('active_tt'); 
    tabMK.classList.remove('active_tt');
    tabYT.classList.remove('active_tt');
    khuyenMaiSection.style.display = 'block';
    yeuThichSection.style.display = 'none';
    donMuaSection.style.display = 'none';
    doiMKSection.style.display = 'none';
    thongTinTKSection.style.display = 'none';
})
tabYT.addEventListener('click', function(){
    tabYT.classList.add('active_tt');
    tabKM.classList.remove('active_tt');
    tabDM.classList.remove('active_tt'); // Thêm class "active" cho tab được chọn
    tabThongTin.classList.remove('active_tt'); 
    tabMK.classList.remove('active_tt');
    yeuThichSection.style.display = 'block';
    khuyenMaiSection.style.display = 'none';
    donMuaSection.style.display = 'none';
    doiMKSection.style.display = 'none';
    thongTinTKSection.style.display = 'none';
})
const tabs = [tabDM_all, tabDM_wait, tabDM_finish, tabDM_cancel];
const tabsections = [allOrderSection, waitPaySection, finishSection, cancelSection];
    
function activateTab(index) {
    tabs.forEach((tab, i) => {
        if (i === index) {
            tab.classList.add('active_bill');
            tabsections[i].style.display = 'block';
        } else {
            tab.classList.remove('active_bill');
            tabsections[i].style.display = 'none';
        }
    });
}
tabs.forEach((tab, index) => {
    tab.addEventListener('click', () => activateTab(index));
});
});