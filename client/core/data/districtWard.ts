import tree from './address.json'
export type TreeType = typeof tree;
export type District = typeof tree['01']['quan-huyen'];

function getDistrictByProvince(id: keyof TreeType): Array<{[key: string]: string}> {
  const province = tree[id]
  const district = province['quan-huyen'] as Record<string, { name_with_type: string }>;
  const newArr = []
  for (const value in district) {
    newArr.push({ title: district[value].name_with_type, value: value })
  }
  return newArr
}

function getDistrictById(id: string, districts: Array<{[key: string]: string}>): string {
  for(const value of districts) {
    if (value.value == id)  return value.title
  }
  return ''
}

function getWardByDistrict(provinceId: keyof TreeType, districtId: keyof District) {
  const province = tree[provinceId]
  const district = province['quan-huyen'] as District;
  const ward = district[districtId]['xa-phuong'] as Record<string, { name_with_type: string }>;
  const newArr = []
  for (const value in ward) {
    newArr.push({ title: ward[value].name_with_type, value: value })
  }
  return newArr
}

function getWardById(id: string, wards: Array<{[key: string]: string}>): string {
  for(const value of wards) {
    if (value.value == id)  return value.title
  }
  return ''
}

export { getDistrictByProvince, getWardByDistrict, getDistrictById, getWardById }
