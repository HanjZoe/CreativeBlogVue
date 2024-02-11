import MyNavBar from "./MyNavBar";
import MyUserGrid from "./MyUserGrid";
import MyPostGrid from "./MyPostGrid";
import MyInput from "./MyInput";
import MyPopup from "./MyPopup";
import MyCategoryGrid from "./MyCategoryGrid";
import MyTagGrid from "./MyTagGrid"
import ShowUser from "../Pages/Admin/Users/ShowUser"
import CreateCategory from "../Pages/Admin/Category/CreateCategory";
import ShowCategory from "../Pages/Admin/Category/ShowCategory";
import CreateTag from "../Pages/Admin/Tags/CreateTags";
import CreateUser from "../Pages/Admin/Users/CreateUser";
import ShowTag from "../Pages/Admin/Tags/ShowTags";
import Select2Wrapper from "./Select2Wrapper"
import AdminNavBar from "./AdminNavBar";
import PostShow from "../Pages/Admin/Posts/PostShow";
import Select2 from 'vue3-select2-component';

export default [
    MyNavBar,
    MyUserGrid,
    MyInput,
    MyPopup,
    MyCategoryGrid,
    MyTagGrid,
    ShowUser,
    CreateCategory,
    CreateTag,
    ShowCategory,
    ShowTag,
    CreateUser,
    MyPostGrid,
    Select2Wrapper,
    AdminNavBar,
    PostShow,
    Select2,
]
// import Vue from 'vue';
//
// const requireComponent = require.context(
//     '../UI', // Путь к вашей папке с компонентами
//     false, // Не включать подпапки
//     /\.vue$/ // Только файлы с расширением .vue
// );
//
// requireComponent.keys().forEach(fileName => {
//     const componentConfig = requireComponent(fileName);
//     const componentName = fileName
//         .split('/')
//         .pop()
//         .replace(/\.\w+$/, '');
//
//     Vue.component(componentName, componentConfig.default || componentConfig);
// });
