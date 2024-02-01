import { Ability } from '@casl/ability'
import type { UserAbility } from './AppAbility'

export const initialAbility: UserAbility[] = [
  {
    action: 'read',
    subject: 'guest',
  },
]

export default new Ability(initialAbility)
