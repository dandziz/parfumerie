import { defineAbility } from '@casl/ability'
import type { UserAbility } from './AppAbility'

export const initialAbility: UserAbility[] = [
  {
    action: 'read',
    subject: 'guest',
  },
]

const existingAbility: UserAbility[] | undefined = getUserAbility()

const ability = defineAbility((can, cannot) => {});
ability.update(existingAbility || initialAbility)

export default ability
