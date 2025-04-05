export default () => {
    const hasSlots = (slots, name) => Object.keys(slots).includes(name);

    const sortTable = (items, field, asc) => {
        return items.sort((a, b) => {
            const multiplier = asc ? 1 : -1;

            return a[field] < b[field] ? -1 * multiplier : a[field] > b[field] ? 1 * multiplier : 0;
        });
    }

    const generateAvatar = (name, size = 32) => {
        const initials = name.split(' ').slice(0, 2)
            .map(word => word[0]?.toUpperCase() || '')
            .join('');

        const svg = `
          <svg width="${size}" height="${size}" viewBox="0 0 ${size} ${size}" xmlns="http://www.w3.org/2000/svg">
            <rect width="100%" height="100%" fill="#F8F7FD"/>
            <text 
              x="50%" 
              y="50%" 
              font-family="Arial" 
              font-size="${size * 0.4}" 
              font-weight="bold" 
              fill="#180D6E"
              text-anchor="middle" 
              dominant-baseline="middle"
            >${initials}</text>
          </svg>
        `;

        return `data:image/svg+xml;base64,${btoa(svg)}`;
    }

    return {
        hasSlots,
        sortTable,
        generateAvatar,
    };
};
