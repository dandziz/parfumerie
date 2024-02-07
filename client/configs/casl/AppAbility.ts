import type { UserRole } from '@/enums'

export type Actions = 'create' | 'read' | 'update' | 'delete' | 'manage' | 'auth'

export type Subjects = UserRole | 'guest'

export interface UserAbility {
  action: Actions
  subject: Subjects
}
