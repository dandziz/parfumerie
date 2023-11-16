export default function (error: string) {
  return error.charAt(0).toUpperCase() + error.slice(1).toLowerCase() + ".";
}
