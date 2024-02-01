export type Breadcrumb = {
  to: string,
  name: string,
  active: boolean
}

type RouteName = {
  name: string
}

export type AdminBreadcrumb = {
  to: RouteName,
  title: string,
  disabled: boolean
}
