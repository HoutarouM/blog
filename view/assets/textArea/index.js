// get elements

const buttons = document.querySelectorAll('.btn')
const fontSizeSelect = document.querySelector('.font-size')
const img = document.getElementById('file')
const textArea = document.getElementById('content')

// events

// return selected text
const getSelectedText = () => {
  let selection = null

  if (textArea.selectionStart === textArea.selectionEnd) {
    selection = textArea.selectionStart
  } else {
    selection = textArea.value.slice(
      textArea.selectionStart,
      textArea.selectionEnd
    )
  }

  return selection
}

// return styled text
const addStyle = (style, selection) => {
  textArea.setRangeText(`<span style="${style};">${selection}</span>`)
}

// return text without style span
const removeStyle = (selection, style) => {
  selection = selection.replace(`<span style="${style};">`, '')
  selection = selection.replace('</span>', '')

  return selection
}

// return list
const createList = (listType, section) => {
  // create list type element
  let res = `<${listType}>`

  // split text by new line
  section = section.split('\n').filter((element) => element)

  // warp selected text lines to list elements
  for (let i = 0; i < section.length; i++) {
    res += '<li>' + section[i] + '</li>'
  }

  // end of list type element
  res += `</${listType}>`

  // return list
  return res
}

const removeList = (selection, listType) => {
  selection = selection.replace(`<${listType}>`, '')
  selection = selection.replace('<li>', '')
  selection = selection.replace('</li>', '')
  selection = selection.replace(`</${listType}>`, '')

  return selection
}

// buttons

buttons.forEach((element) => {
  let isActive = false

  element.onclick = () => {
    // get selected text
    let selection = getSelectedText()

    // get html data- attr value
    const attr = element.dataset.element

    // style for span
    let style = null

    // object like list or image
    let obj = null

    // switch with style property's
    switch (attr) {
      case 'strong':
        style = 'font-weight: bold'
        break

      case 'italic':
        style = 'font-style: italic'
        break

      case 'underline':
        style = 'text-decoration: underline'
        break

      case 'ul':
        obj = 'ul'
        break

      case 'ol':
        obj = 'ol'
        break

      case 'img':
        obj = 'img'
        break

      default:
        break
    }

    if (style !== null) {
      if (!isActive) {
        // if no style add style

        // able property
        isActive = true

        // add span with style
        addStyle(style, selection)
      } else {
        // if style exist remove

        // disable property
        isActive = false

        // remove span with style
        selection = removeStyle(selection, style)

        // change textarea value
        textArea.setRangeText(selection)
      }
    }

    if (obj !== null) {
      if (obj === 'ul' || obj === 'ol') {
        if (!isActive) {
          // if no list add

          // able property
          isActive = true

          // add list
          selection = createList(obj, selection)
        } else {
          // if list exist remove

          // disable property
          isActive = false

          // remove span with style
          selection = removeList(selection, obj)
        }

        // change textarea value
        textArea.setRangeText(selection)
      }
    }
  }
})

// img

img.onchange = () => {
  // object like list or image
  let src = img.value

  // remove fakepath
  src = src.replace('C:\\fakepath\\', '')

  // add img
  textArea.setRangeText(`<img src="${src}">`)
}

// select

// save prev font size for change if span exist
let prevFontSize

fontSizeSelect.onchange = () => {
  // get selected text
  let selection = getSelectedText()

  // get html data- attr value
  let fontSize = fontSizeSelect.value

  // if span exist change font-size
  // else create span
  if (prevFontSize) {
    // change font-size value
    selection = selection.replace(prevFontSize, fontSize)

    // change textarea value
    textArea.setRangeText(selection)
  } else {
    // add style property
    fontSize = 'font-size: ' + fontSize

    // add span with style
    addStyle(fontSize, selection)
  }

  // save prev font size
  prevFontSize = fontSize
}
