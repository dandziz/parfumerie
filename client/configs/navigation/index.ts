export default [
  {
    title: 'Dashboard',
    to: { name: 'index' },
    icon: { icon: 'mdi-home-outline' },
  },
  {
    title: 'Quản lý nước hoa',
    icon: { icon: 'icon-park-solid:perfume' },
    children: [
      {
        title: 'Danh sách nước hoa',
        to: { name: 'user' },
        icon: { icon: 'material-symbols:format-list-bulleted-rounded' },
      },
      {
        title: 'Thêm nước hoa',
        to: { name: 'user-create' },
        icon: { icon: 'material-symbols:add-circle-outline' },
      },
    ],
  },
]
