# -*- coding: utf-8 -*-

import re


def clean_whitespace(title):
    return re.sub(r'\s+', ' ', title).strip()
