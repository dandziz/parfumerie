const province = [
  {
    "title": "An Giang",
    "value": "89"
  },
  {
    "title": "Bà Rịa - Vũng Tàu",
    "value": "77"
  },
  {
    "title": "Bình Dương",
    "value": "74"
  },
  {
    "title": "Bình Phước",
    "value": "70"
  },
  {
    "title": "Bình Thuận",
    "value": "60"
  },
  {
    "title": "Bình Định",
    "value": "52"
  },
  {
    "title": "Bạc Liêu",
    "value": "95"
  },
  {
    "title": "Bắc Giang",
    "value": "24"
  },
  {
    "title": "Bắc Kạn",
    "value": "06"
  },
  {
    "title": "Bắc Ninh",
    "value": "27"
  },
  {
    "title": "Bến Tre",
    "value": "83"
  },
  {
    "title": "Cao Bằng",
    "value": "04"
  },
  {
    "title": "Cà Mau",
    "value": "96"
  },
  {
    "title": "Cần Thơ",
    "value": "92"
  },
  {
    "title": "Gia Lai",
    "value": "64"
  },
  {
    "title": "Hoà Bình",
    "value": "17"
  },
  {
    "title": "Hà Giang",
    "value": "02"
  },
  {
    "title": "Hà Nam",
    "value": "35"
  },
  {
    "title": "Hà Nội",
    "value": "01"
  },
  {
    "title": "Hà Tĩnh",
    "value": "42"
  },
  {
    "title": "Hưng Yên",
    "value": "33"
  },
  {
    "title": "Hải Dương",
    "value": "30"
  },
  {
    "title": "Hải Phòng",
    "value": "31"
  },
  {
    "title": "Hậu Giang",
    "value": "93"
  },
  {
    "title": "Khánh Hòa",
    "value": "56"
  },
  {
    "title": "Kiên Giang",
    "value": "91"
  },
  {
    "title": "Kon Tum",
    "value": "62"
  },
  {
    "title": "Lai Châu",
    "value": "12"
  },
  {
    "title": "Long An",
    "value": "80"
  },
  {
    "title": "Lào Cai",
    "value": "10"
  },
  {
    "title": "Lâm Đồng",
    "value": "68"
  },
  {
    "title": "Lạng Sơn",
    "value": "20"
  },
  {
    "title": "Nam Định",
    "value": "36"
  },
  {
    "title": "Nghệ An",
    "value": "40"
  },
  {
    "title": "Ninh Bình",
    "value": "37"
  },
  {
    "title": "Ninh Thuận",
    "value": "58"
  },
  {
    "title": "Phú Thọ",
    "value": "25"
  },
  {
    "title": "Phú Yên",
    "value": "54"
  },
  {
    "title": "Quảng Bình",
    "value": "44"
  },
  {
    "title": "Quảng Nam",
    "value": "49"
  },
  {
    "title": "Quảng Ngãi",
    "value": "51"
  },
  {
    "title": "Quảng Ninh",
    "value": "22"
  },
  {
    "title": "Quảng Trị",
    "value": "45"
  },
  {
    "title": "Sóc Trăng",
    "value": "94"
  },
  {
    "title": "Sơn La",
    "value": "14"
  },
  {
    "title": "Thanh Hóa",
    "value": "38"
  },
  {
    "title": "Thái Bình",
    "value": "34"
  },
  {
    "title": "Thái Nguyên",
    "value": "19"
  },
  {
    "title": "Thừa Thiên Huế",
    "value": "46"
  },
  {
    "title": "Tiền Giang",
    "value": "82"
  },
  {
    "title": "TP Hồ Chí Minh",
    "value": "79"
  },
  {
    "title": "Trà Vinh",
    "value": "84"
  },
  {
    "title": "Tuyên Quang",
    "value": "08"
  },
  {
    "title": "Tây Ninh",
    "value": "72"
  },
  {
    "title": "Vĩnh Long",
    "value": "86"
  },
  {
    "title": "Vĩnh Phúc",
    "value": "26"
  },
  {
    "title": "Yên Bái",
    "value": "15"
  },
  {
    "title": "Điện Biên",
    "value": "11"
  },
  {
    "title": "Đà Nẵng",
    "value": "48"
  },
  {
    "title": "Đắk Lắk",
    "value": "66"
  },
  {
    "title": "Đắk Nông",
    "value": "67"
  },
  {
    "title": "Đồng Nai",
    "value": "75"
  },
  {
    "title": "Đồng Tháp",
    "value": "87"
  }
]

function getProvince(): Array<{[key: string]: string}> {
  return province
}

function getProvinceById(id: string): string {
  for(const value of province) {
    if (value.value == id)  return value.title
  }
  return ''
}

export { getProvince, getProvinceById }
