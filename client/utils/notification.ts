const { notify } = useNotification();

export function successfulNotification(_title: string, _content='') {
  notify({
    title: _title,
    text: _content,
    type: 'success'
  })
}

export function failureNotification(_title: string, _content='') {
  notify({
    title: _title,
    text: _content,
    type: 'error'
  })
}
