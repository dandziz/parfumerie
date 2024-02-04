export default [
  {
    title: 'Dashboard',
    to: { name: 'admin' },
    icon: { icon: 'mdi-home-outline' },
  },
  {
    title: 'Quản lý nước hoa',
    icon: { icon: 'mdi-bottle-soda-classic-outline' },
    represent: 'perfume',
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
  {
    title: 'Quản lý thương hiệu',
    icon: { icon: 'mdi-label-multiple-outline' },
    represent: 'brand',
    children: [
      {
        title: 'Danh sách thương hiệu',
        to: { name: 'admin-brand' },
        icon: { icon: 'mdi-list-box-outline' },
      },
      {
        title: 'Thêm thương hiệu',
        to: { name: 'admin-brand-create' },
        icon: { icon: 'mdi-plus-box-outline' },
      },
    ],
  },
]
