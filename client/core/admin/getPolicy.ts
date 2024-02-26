import policy from "./index";
import type { Policy } from "~/types";

function getAuth(name: string, parentObject: Policy, route: string) {
  for(const [key, value] of Object.entries(parentObject)) {
    if ((name + '-' + key) === route) {
      return value[0]
    }
    if(value.length == 2) {
      const result = getAuth(name + '-' + key, value[1] as Policy, route) as string[][] | number;
      if (Array.isArray(result)) {
        return result;
      }
    }
  }
}

export function getNameRoute(routeName: string) {
  for(const [key, value] of Object.entries(policy)) {
    if (key == routeName) return value[0]
    if (value.length == 2)  {
      const auth = getAuth(key, value[1] as Policy, routeName)
      if (auth) return auth
    }
  }
  return -1
}
