export default [
  {
    title: 'Dashboard',
    to: { name: 'admin' },
    icon: { icon: 'mdi-home-outline' },
  },
  {
    title: 'Quản lý nước hoa',
    icon: { icon: 'mdi-bottle-soda-classic-outline' },
    children: [
      {
        title: 'Danh sách nước hoa',
        to: { name: 'admin-perfume' },
        icon: { icon: 'mdi-list-box-outline' },
      },
      {
        title: 'Thêm nước hoa',
        to: { name: 'admin-perfume-create' },
        icon: { icon: 'mdi-plus-box-outline' },
      },
    ],
  },
]
